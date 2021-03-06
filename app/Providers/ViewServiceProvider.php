<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // About
        View::composer('about', 'App\View\Composers\AboutComposer');

        // ToS/Privacy
        View::composer('tos', 'App\View\Composers\AboutComposer');
        View::composer('privacy', 'App\View\Composers\AboutComposer');

        // FAQs
        View::composer('faqs', 'App\View\Composers\AboutComposer');

        // Addictions
        View::composer('addictions.*', 'App\View\Composers\AddictionsComposer');

        // Affirmations
        View::composer('affirmations.*', 'App\View\Composers\AffirmationsComposer');

        // Auth
        View::composer('auth.*', 'App\View\Composers\AuthComposer');

        // Bucketlist
        View::composer('bucketlist.*', 'App\View\Composers\BucketlistComposer');

        // Feature Vote
        View::composer('feature.*', 'App\View\Composers\FeatureVoteComposer');

        // Goals
        View::composer('goals.*', 'App\View\Composers\GoalsComposer');

        // Habits
        View::composer('habits.*', 'App\View\Composers\HabitsComposer');

        // Home
        View::composer('home.*', 'App\View\Composers\HomeComposer');

        // Journal
        View::composer('journal.*', 'App\View\Composers\JournalComposer');

        // Profile
        View::composer('profile.*', 'App\View\Composers\ProfileComposer');
        View::composer('profile.edit.settings', 'App\View\Composers\SettingsComposer');

        // Support
        View::composer('support.*', 'App\View\Composers\SupportComposer');

        // ToDo
        View::composer('todo.*', 'App\View\Composers\ToDoComposer');
    }
}