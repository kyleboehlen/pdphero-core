<span class="time-spacer summary-hide summary-show-journal-entry"></span>
<span class="time-label summary-hide summary-show-journal-entry">{{ $journal_entry->display_time }}</span>
<div class="summary summary-hide summary-journal-entry summary-show-journal-entry">
    <div class="text">
        @if(!is_null($before_title) && !is_null($matching_title) && !is_null($after_title))
            <b>{{ $before_title }}<span class="search-highlight {{ $mood }}">{{ $matching_title }}</span>{{ $after_title }} |</b>
        @else
            <b>{{ $journal_entry->title }} |</b>
        @endif
        <a class="preview" href="{{ route('journal.view.entry', ['journal_entry' => $journal_entry]) }}">
            <i>
                @if(!is_null($before_body) && !is_null($matching_text) && !is_null($after_body))
                    {{ $before_body }}<span class="search-highlight {{ $mood }}">{{ $matching_text }}</span>{{ $after_body }}
                @else
                    {{ $journal_entry->body }}
                @endif
            </i>
        </a>
    </div>
    <div class="mood {{ $mood }}"></div>
</div>