<?php

use App\Helpers\Constants\Home\Home;

return [
    HOME::GOALS => [
        'name' => 'Goals',
        'desc' => 'The goals tool.',
        'img' => 'icons/goals-white.png',
        'route' => 'goals',
    ],
    HOME::HABITS => [
        'name' => 'Habits',
        'desc' => 'The habits tool.',
        'img' => 'icons/habits-white.png',
        'route' => 'habits',
    ],
    HOME::JOURNAL => [
        'name' => 'Journal',
        'desc' => 'The journal tool and timeline.',
        'img' => 'icons/journal-white.png',
        'route' => 'journal',
    ],
    HOME::PROFILE => [
        'name' => 'Profile',
        'desc' => 'View user stats, manage values, nutshell, and personal rules.',
        'img' => 'icons/profile-white.png',
        'route' => 'profile',
    ],
    HOME::SETTINGS => [
        'name' => 'Settings',
        'desc' => 'Manage application settings and customize your experience.',
        'img' => 'icons/settings-white.png',
        'route' => 'profile.edit.settings',
    ],
    HOME::TODO => [
        'name' => 'To-Do',
        'desc' => 'Manage your To-Do items.',
        'img' => 'icons/todo-white.png',
        'route' => 'todo.list',
    ],
    HOME::AFFIRMATIONS => [
        'name' => 'Affirmations',
        'desc' => 'Read your affirmations.',
        'img' => 'icons/smile-white.png',
        'route' => 'affirmations',
    ],
    HOME::EMAIL_SUPPORT => [
        'name' => 'Email Support',
        'desc' => 'Send a message to our email support.',
        'img' => 'icons/email-support-white.png',
        'route' => 'support.email.form',
    ],
    HOME::FEATURE_VOTE => [
        'name' => 'Feature Vote',
        'desc' => 'Vote for which features you want to see built out next.',
        'img' => 'icons/feature-vote-white.png',
        'route' => 'feature.list',
    ],
    HOME::TUTORIALS => [
        'name' => 'Tutorials',
        'desc' => 'Watch PDPHero tutorials.',
        'img' => 'icons/tutorials-white.png',
        'route' => 'tutorials',
    ],
    HOME::BUCKET_LIST => [
        'name' => 'Bucket List',
        'desc' => 'Track your bucket list items.',
        'img' => 'icons/bucketlist-white.png',
        'route' => 'bucketlist',
    ],
    HOME::ADDICTIONS => [
        'name' => 'Addictions',
        'desc' => 'Take control of your vices while tracking milestones and learning from relapses',
        'img' => 'icons/addiction-white.png',
        'route' => 'addictions',
    ],
];