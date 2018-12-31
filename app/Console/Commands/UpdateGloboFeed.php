<?php

namespace App\Console\Commands;

use App\Models\TaskControl;
use App\Models\V1\NewFeed;
use App\Services\V1\GloboFeed\Contract\FeedIntegration;
use App\Services\V1\GloboFeed\Data\Entity\Feed;
use Illuminate\Console\Command;

class UpdateGloboFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_feed:globo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando responsável por atualizar o feed de posts da Globo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param FeedIntegration $feedIntegration
     * @return mixed
     */
    public function handle(FeedIntegration $feedIntegration)
    {
        $lastTask = TaskControl::where('name', '=', 'GLOBO_FEED')
            ->orderBy('last_execution', 'ASC')
            ->first();

        if (empty($lastTask)) {
            $this->updateFeed($feedIntegration);
        } else {
            $lastExecution = $lastTask->last_execution;
            $diffLastExecutionFromNow = $lastExecution->diff(new \DateTime());

            if ($diffLastExecutionFromNow->h > 4) {
                $this->updateFeed($feedIntegration);
            }
        }
    }

    /**
     * Atualiza as publicações do feed.
     *
     * @param FeedIntegration $feedIntegration
     */
    private function updateFeed($feedIntegration)
    {
        $feedCollection = $feedIntegration->getFeed();

        if (empty($feedCollection) || $feedCollection->count() === 0) {
            return;
        }

        /** @var Feed $news */
        foreach ($feedCollection as $news) {
            $newExists = NewFeed::select('id')
                ->where('guid', '=', $news->getGuid()
                )->first();

            if ($newExists) {
                continue;
            }

            $newModel = new NewFeed([
                'title' => $news->getTitle(),
                'link' => $news->getLink(),
                'guid' => $news->getGuid(),
                'description' => $news->getDescription(),
                'publication_date' => $news->getPublicationDate(),
                'category' => $news->getCategory()
            ]);
            $newModel->save();
        }

        TaskControl::create([
            'name' => 'GLOBO_FEED',
            'last_execution' => new \DateTime()
        ]);
    }
}
