<?php

namespace App\Http\Middleware\Journal;

use Closure;
use Illuminate\Http\Request;

class EntryUUID
{
    /**
     * Verifies that any goal UUIDs in the URL
     * string belong to the authenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if UUID is being passed in url string
        if(!is_null($journal_entry = $request->route('journal_entry')))
        {
            if($journal_entry->user_id != $request->user()->id) // Verify goal belongs to user
            {
                return abort(403); // Return forbidden if different user's goal
            }
        }
        return $next($request);
    }
}
