<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddictionController;
use App\Http\Controllers\AffirmationsController;
use App\Http\Controllers\BucketListController;
use App\Http\Controllers\FeatureVoteController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HabitsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PushController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\TutorialsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes(['verify' => true]);

// Root route, controls whether or not user gets sent to about or home
Route::get('/', [HomeController::class, 'index'])->name('root');

// Main about page
Route::get('about', [AboutController::class, 'index'])->name('about');

// Privacy policy/tos
Route::get('privacy', [AboutController::class, 'privacy'])->name('privacy');
Route::get('tos', [AboutController::class, 'tos'])->name('tos');

// FAQ
Route::get('faqs', [AboutController::class, 'faqs'])->name('faqs');

// Tutorials
Route::get('tutorials', [TutorialsController::class, 'index'])->name('tutorials');

// Referal sign up link
Route::get('refer/{slug}', [HomeController::class, 'refer']);

// Web push store subscribtion
Route::post('push', [PushController::class, 'store']);

// Home route
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'verified']], function(){
    // View tools page
    Route::get('/', [HomeController::class, 'home'])->name('home');

    // Edit/update routes
    Route::get('edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::post('hide/{home}', [HomeController::class, 'hide'])->name('home.hide');
    Route::post('show/{home}', [HomeController::class, 'show'])->name('home.show');
});

// Journal
Route::prefix('journal')->group(function(){
    // Root
    Route::get('/', [JournalController::class, 'index'])->name('journal');

    // View the journal mood colors guide
    Route::get('colors', [JournalController::class, 'colorGuide'])->name('journal.colors');

    // Views
    Route::prefix('view')->group(function(){
        // List view
        Route::get('list/{month?}/{year?}', [JournalController::class, 'viewList'])->name('journal.view.list')
            ->where('month', config('regex.month_name'))
            ->where('year', config('regex.year'));

        // Day view
        Route::get('day/{date}', [JournalController::class, 'viewDay'])->name('journal.view.day')
            ->where('date', config('regex.route_date'));

        // Entry view
        Route::get('entry/{journal_entry}', [JournalController::class, 'viewEntry'])->name('journal.view.entry');

        // ToDo view
        Route::get('todo/{todo}', [JournalController::class, 'viewToDo'])->name('journal.view.todo');
    });

    // Search functionality
    Route::get('search', [JournalController::class, 'search'])->name('journal.search');

    // Create Entry
    Route::get('create/entry', [JournalController::class, 'createEntry'])->name('journal.create.entry');

    // Store routes
    Route::prefix('store')->group(function(){
        Route::post('category', [JournalController::class, 'storeCategory'])->name('journal.store.category');
        Route::post('entry', [JournalController::class, 'storeEntry'])->name('journal.store.entry');
    });

    // Edit routes
    Route::prefix('edit')->group(function(){
        Route::get('categories', [JournalController::class, 'editCategories'])->name('journal.edit.categories');
        Route::get('entry/{journal_entry}', [JournalController::class, 'editEntry'])->name('journal.edit.entry');
    });

    // Update entry
    Route::post('update/entry/{journal_entry}', [JournalController::class, 'updateEntry'])->name('journal.update.entry');

    // Delete routes
    Route::prefix('destory')->group(function(){
        Route::post('category/{category}', [JournalController::class, 'destroyCategory'])->name('journal.destroy.category');
        Route::post('destroy/entry/{journal_entry}', [JournalController::class, 'destroyEntry'])->name('journal.destroy.entry');
    });
});

// Goals
Route::prefix('goals')->group(function(){
    // Types route
    Route::get('types', [GoalController::class, 'types'])->name('goals.types');

    // Shift dates route
    Route::post('shift-dates/{goal}', [GoalController::class, 'shiftDates'])->name('goals.shift-dates');

    // Remove parent/convert to sub goal
    Route::post('remove-parent/{goal}', [GoalController::class, 'removeParent'])->name('goals.remove-parent');
    Route::get('convert-sub/{goal}', [GoalController::class, 'convertSubForm'])->name('goals.convert-sub.form');
    Route::post('convert-sub/{goal}', [GoalController::class, 'convertSubSubmit'])->name('goals.convert-sub.submit');

    // Transfer ad hoc items
    Route::get('transfer-ad-hoc-items/{goal}', [GoalController::class, 'transferAdHocItemsForm'])->name('goals.transfer-ad-hoc-items.form');
    Route::post('transfer-ad-hoc-items/{goal}', [GoalController::class, 'transferAdHocItemsSubmit'])->name('goals.transfer-ad-hoc-items.submit');

    // Ad Hoc Deadlines
    Route::prefix('ad-hoc-deadline')->group(function(){
        Route::post('set/{action_item}', [GoalController::class, 'setAdHocDeadline'])->name('goals.ad-hoc-deadline.set');
        Route::post('clear/{action_item}', [GoalController::class, 'clearAdHocDeadline'])->name('goals.ad-hoc-deadline.clear');
    });

    // Bucketlist Deadline
    Route::prefix('bucketlist-deadline')->group(function(){
        Route::post('set/{bucketlist_item}/{goal}', [GoalController::class, 'setBucketlistDeadline'])->name('goals.bucketlist-deadline.set');
        Route::post('clear/{bucketlist_item}', [GoalController::class, 'clearBucketlistDeadline'])->name('goals.bucketlist-deadline.clear');
    });
    
    // Toggle Completed routes
    Route::prefix('toggle-achieved')->group(function(){
        Route::post('goal/{goal}', [GoalController::class, 'toggleAchievedGoal'])->name('goals.toggle-achieved.goal');
        Route::post('action-item/{action_item}', [GoalController::class, 'toggleAchievedActionItem'])->name('goals.toggle-achieved.action-item');
        Route::post('bucketlist-item/{bucketlist_item}', [GoalController::class, 'toggleAchievedBucketlistItem'])->name('goals.toggle-achieved.bucketlist-item');
    });

    // View routes
    Route::prefix('view')->group(function(){
        Route::get('goal/{goal}', [GoalController::class, 'viewGoal'])->name('goals.view.goal');
        Route::get('action-item/{action_item}', [GoalController::class, 'viewActionItem'])->name('goals.view.action-item');
        Route::get('bucketlist-item/{bucketlist_item}/{goal?}', [GoalController::class, 'viewBucketlistItem'])->name('goals.view.bucketlist-item');
    });

    // Create routes
    Route::prefix('create')->group(function(){
        Route::get('goal', [GoalController::class, 'createGoal'])->name('goals.create.goal');
        Route::get('action-item/{goal}', [GoalController::class, 'createActionItem'])->name('goals.create.action-item');
    });

    // Store routes
    Route::prefix('store')->group(function(){
        Route::post('goal', [GoalController::class, 'storeGoal'])->name('goals.store.goal');
        Route::post('action-item/{goal}', [GoalController::class, 'storeActionItem'])->name('goals.store.action-item');
        Route::post('category', [GoalController::class, 'storeCategory'])->name('goals.store.category');
        Route::post('reminder/{action_item}', [GoalController::class, 'storeReminder'])->name('goals.store.reminder');
    });
    
    // Edit routes
    Route::prefix('edit')->group(function(){
        Route::get('goal/{goal}', [GoalController::class, 'editGoal'])->name('goals.edit.goal');
        Route::get('action-item/{action_item}', [GoalController::class, 'editActionItem'])->name('goals.edit.action-item');
        Route::get('categories', [GoalController::class, 'editCategories'])->name('goals.edit.categories');
        Route::get('reminders/{action_item}', [GoalController::class, 'editReminders'])->name('goals.edit.reminders');
    });

    // Update routes
    Route::prefix('update')->group(function(){
        Route::post('goal/{goal}', [GoalController::class, 'updateGoal'])->name('goals.update.goal');
        Route::post('action-item/{action_item}', [GoalController::class, 'updateActionItem'])->name('goals.update.action-item');
        Route::post('manual-progress/{goal}', [GoalController::class, 'updateManualProgress'])->name('goals.update.manual-progress');
    });

    // Destroy routes
    Route::prefix('destroy')->group(function(){
        Route::post('goal/{goal}', [GoalController::class, 'destroyGoal'])->name('goals.destroy.goal');
        Route::post('action-item/{action_item}', [GoalController::class, 'destroyActionItem'])->name('goals.destroy.action-item');
        Route::post('category/{category}', [GoalController::class, 'destroyCategory'])->name('goals.destroy.category');
        Route::post('reminder/{reminder}', [GoalController::class, 'destroyReminder'])->name('goals.destroy.reminder');
    });

    // Root -- at the end of the prefix so scope/category don't block other routes
    Route::get('/{scope?}/{category?}', [GoalController::class, 'index'])->name('goals');
});

// Habits
Route::prefix('habits')->group(function(){
    // Root
    Route::get('/', [HabitsController::class, 'index'])->name('habits');

    // View details/history
    Route::get('view/{habit}', [HabitsController::class, 'view'])->name('habits.view');

    // View the habits color guide
    Route::get('colors', [HabitsController::class, 'colorGuide'])->name('habits.colors');

    // Add form/add routes
    Route::get('create', [HabitsController::class, 'create'])->name('habits.create');
    Route::post('store', [HabitsController::class, 'store'])->name('habits.store');

    // Edit/Update routes
    Route::get('edit/{habit}', [HabitsController::class, 'edit'])->name('habits.edit');
    Route::post('update/{habit}', [HabitsController::class, 'update'])->name('habits.update');

    // Delete
    Route::post('destroy/{habit}', [HabitsController::class, 'destroy'])->name('habits.destroy');

    // Update habit history
    Route::post('history/{habit}', [HabitsController::class, 'history'])->name('habits.history');

    // Manage reminders
    Route::get('edit/reminders/{habit}', [HabitsController::class, 'editReminders'])->name('habits.edit.reminders');
    Route::post('store/reminder/{habit}', [HabitsController::class, 'storeReminder'])->name('habits.store.reminder');
    Route::post('destroy/reminder/{reminder}', [HabitsController::class, 'destroyReminder'])->name('habits.destroy.reminder');

    // Get soonest a strength can be hit on a habit
    Route::post('soonest/{habit}/{strength?}', [HabitsController::class, 'soonest'])->name('habits.soonest');
});

// Affirmations
Route::prefix('affirmations')->group(function(){
    // Index
    Route::get('/', [AffirmationsController::class, 'index'])->name('affirmations');

    // Add form/add route
    Route::get('create', [AffirmationsController::class, 'create'])->name('affirmations.create');
    Route::post('store', [AffirmationsController::class, 'store'])->name('affirmations.store');

    // Show, edit, update, and destroy routes for
    // individual affirmations
    Route::get('show/{affirmation}', [AffirmationsController::class, 'show'])->name('affirmations.show');
    Route::get('edit/{affirmation}', [AffirmationsController::class, 'edit'])->name('affirmations.edit');
    Route::post('update/{affirmation}', [AffirmationsController::class, 'update'])->name('affirmations.update');
    Route::post('destroy/{affirmation}', [AffirmationsController::class, 'destroy'])->name('affirmations.destroy');

    // This route handles verifying and making note that the affirmations list was read
    Route::post('read', [AffirmationsController::class, 'checkRead'])->name('affirmations.read.check');
    Route::get('read', [AffirmationsController::class, 'showRead'])->name('affirmations.read.show');
});

// Profile
Route::prefix('profile')->group(function(){
    // Root
    Route::get('/', [ProfileController::class, 'index'])->name('profile');

    // Edit routes
    Route::prefix('edit')->group(function(){
        // Show edit settings page
        Route::get('settings', [ProfileController::class, 'editSettings'])->name('profile.edit.settings');

        // Show edit name page
        Route::get('name', [ProfileController::class, 'editName'])->name('profile.edit.name');

        // Show edit nutshell page
        Route::get('nutshell', [ProfileController::class, 'editNutshell'])->name('profile.edit.nutshell');

        // Show edit values page
        Route::get('values', [ProfileController::class, 'editValues'])->name('profile.edit.values');

        // Show edit rules page
        Route::get('rules', [ProfileController::class, 'editRules'])->name('profile.edit.rules');
    });

    // Update routes
    Route::prefix('update')->group(function(){
        // Update settings route
        Route::post('settings/{id}', [ProfileController::class, 'updateSettings'])->name('profile.update.settings');

        // Update routes for profile-picture, name, values, nutshell, rules
        Route::post('name', [ProfileController::class, 'updateName'])->name('profile.update.name');
        Route::post('values', [ProfileController::class, 'updateValues'])->name('profile.update.values');
        Route::post('nutshell', [ProfileController::class, 'updateNutshell'])->name('profile.update.nutshell');
        Route::post('rules', [ProfileController::class, 'updateRules'])->name('profile.update.rules');

        // Profile picture upload throttled
        Route::middleware(['throttle:profile-pictures'])->group(function(){
            Route::post('picture', [ProfileController::class, 'updatePicture'])->name('profile.update.picture');
        });
    });

    // Delete route
    Route::prefix('destroy')->group(function(){
        // Value/rule
        Route::post('value', [ProfileController::class, 'destroyValue'])->name('profile.destroy.value');
        Route::post('rule', [ProfileController::class, 'destroyRule'])->name('profile.destroy.rule');

        // Sets all settings to default
        Route::post('settings', [ProfileController::class, 'destroySettings'])->name('profile.destroy.settings');
    });

    // SMS routes
    Route::prefix('sms')->group(function(){
        // Edit/update
        Route::get('edit', [ProfileController::class, 'editSMS'])->name('profile.sms.edit');
        Route::post('update', [ProfileController::class, 'updateSMS'])->name('profile.sms.update');

        // Verification
        Route::get('verify', [ProfileController::class, 'showVerifySMS'])->name('profile.sms.verify.show');
        Route::post('verify', [ProfileController::class, 'verifySMS'])->name('profile.sms.verify');
    });
});

// To-Do routes
Route::prefix('todo')->group(function(){
    // Root
    Route::get('/', [ToDoController::class, 'index'])->name('todo.list');

    // View details
    Route::get('view/{todo}', [ToDoController::class, 'viewDetails'])->name('todo.view.details');

    // View the todo priority colors guide
    Route::get('colors', [ToDoController::class, 'colorGuide'])->name('todo.colors');

    // Show the create to do item form
    Route::get('create', [ToDoController::class, 'create'])->name('todo.create');
    Route::get('create-habit', [ToDoController::class, 'createHabit'])->name('todo.create.habit');

    // Submit the create to do item form
    Route::post('store', [ToDoController::class, 'store'])->name('todo.store');
    Route::post('store-habit', [ToDoController::class, 'storeHabit'])->name('todo.store.habit');
    Route::post('store/category', [ToDoController::class, 'storeCategory'])->name('todo.store.category');

    // Show the form to edit categories (make sure this stays above todo.edit)
    Route::get('edit/categories', [ToDoController::class, 'editCategories'])->name('todo.edit.categories');

    // Show the edit to do item form
    Route::get('edit/{todo}', [ToDoController::class, 'edit'])->name('todo.edit');

    // Submit the edit to do item form
    Route::post('update/{todo}', [ToDoController::class, 'update'])->name('todo.update');
    Route::post('update-habit/{todo}', [ToDoController::class, 'updateHabit'])->name('todo.update.habit');

    // Delete a to do category (make sure this stays above todo.destroy)
    Route::post('destroy/category/{category}', [ToDoController::class, 'destroyCategory'])->name('todo.destroy.category');

    // Delete a to do item
    Route::post('destroy/{todo}', [ToDoController::class, 'destroy'])->name('todo.destroy');

    // Toggle a to do item's completed status
    Route::post('toggle-completed/{todo}/{view_details?}', [ToDoController::class, 'toggleCompleted'])->name('todo.toggle-completed');

    // Move a to-do item to the top of the list
    Route::post('move-to-top/{todo}', [ToDoController::class, 'moveToTop'])->name('todo.move-to-top');

    // Manage to-do reminders
    Route::get('edit/reminders/{todo}', [ToDoController::class, 'editReminders'])->name('todo.edit.reminders');
    Route::post('store/reminder/{todo}', [ToDoController::class, 'storeReminder'])->name('todo.store.reminder');
    Route::post('destroy/reminder/{reminder}', [ToDoController::class, 'destroyReminder'])->name('todo.destroy.reminder');
});

// Support
Route::prefix('support')->group(function(){
    // Email support form
    Route::get('/', [SupportController::class, 'showEmailForm'])->name('support.email.form');

    // Submit email form
    Route::post('submit', [SupportController::class, 'submitEmailForm'])->name('support.email.submit');
});

// Stripe
Route::get('stripe', [StripeController::class, 'index'])->name('stripe');

// Feature vote
Route::prefix('feature-vote')->group(function(){
    // Index
    Route::get('/', [FeatureVoteController::class, 'index'])->name('feature.list');

    // Details
    Route::get('/{feature}', [FeatureVoteController::class, 'details'])->name('feature.details');

    // Vote
    Route::post('/{feature}', [FeatureVoteController::class, 'vote'])->name('feature.vote');
});

// Bucketlist
Route::prefix('bucketlist')->group(function(){
    // Index (incomplete items)
    Route::get('/', [BucketListController::class, 'index'])->name('bucketlist');

    // Completed timeline view
    Route::get('completed', [BucketListController::class, 'viewCompleted'])->name('bucketlist.view.completed');

    // Create/edit
    Route::get('create', [BucketlistController::class, 'create'])->name('bucketlist.create');
    Route::get('edit/{bucketlist_item}', [BucketlistController::class, 'edit'])->name('bucketlist.edit');
    Route::post('store', [BucketlistController::class, 'store'])->name('bucketlist.store');
    Route::post('update/{bucketlist_item}', [BucketlistController::class, 'update'])->name('bucketlist.update');

    // Edit/create/delete categories
    Route::get('categories', [BucketlistController::class, 'editCategories'])->name('bucketlist.edit.categories');
    Route::post('store/category', [BucketlistController::class, 'storeCategory'])->name('bucketlist.store.category');
    Route::post('destroy/category/{category}', [BucketlistController::class, 'destroyCategory'])->name('bucketlist.destroy.category');

    // Toggle a bucketlist item's completed status
    Route::post('mark-completed/{bucketlist_item}/{view_details?}', [BucketListController::class, 'markCompleted'])->name('bucketlist.mark-completed');
    Route::post('mark-incomplete/{bucketlist_item}/{view_details?}', [BucketListController::class, 'markIncomplete'])->name('bucketlist.mark-incomplete');

    // View details
    Route::get('view/{bucketlist_item}', [BucketListController::class, 'viewDetails'])->name('bucketlist.view.details');

    // Destroy
    Route::post('destroy/{bucketlist_item}', [BucketlistController::class, 'destroy'])->name('bucketlist.destroy');
});

// Addictions
Route::prefix('addictions')->group(function(){
    // Index
    Route::get('/', [AddictionController::class, 'index'])->name('addictions');

    // View details
    Route::get('details/{addiction}', [AddictionController::class, 'details'])->name('addiction.details');

    // Create/edit routes
    Route::get('create', [AddictionController::class, 'create'])->name('addiction.create');
    Route::post('store', [AddictionController::class, 'store'])->name('addiction.store');
    Route::get('edit/{addiction}', [AddictionController::class, 'edit'])->name('addiction.edit');
    Route::post('update/{addiction}', [AddictionController::class, 'update'])->name('addiction.update');

    // Milestones routes
    Route::prefix('milestones')->group(function(){
        Route::get('{addiction}', [AddictionController::class, 'milestones'])->name('addiction.milestones');
        Route::get('create/{addiction}', [AddictionController::class, 'milestoneForm'])->name('addiction.milestone.create');
        Route::post('store/{addiction}', [AddictionController::class, 'storeMilestone'])->name('addiction.milestone.store');
        Route::post('destroy/{milestone}', [AddictionController::class, 'destroyMilestone'])->name('addiction.milestone.destroy');
    });

    // Usage routes
    Route::prefix('relapse')->group(function(){
        Route::get('timeline/{addiction}', [AddictionController::class, 'viewRelapseTimeline'])->name('addiction.relapse.timeline');
        Route::get('create/{addiction}', [AddictionController::class, 'relapseForm'])->name('addiction.relapse.create');
        Route::post('store/{addiction}', [AddictionController::class, 'storeRelapse'])->name('addiction.relapse.store');
        Route::post('usage/{addiction}', [AddictionController::class, 'storeModeratedUsage'])->name('addiction.usage.store');
    });

    // Destroy route
    Route::post('destory/{addiction}', [AddictionController::class, 'destroy'])->name('addiction.destroy');
});