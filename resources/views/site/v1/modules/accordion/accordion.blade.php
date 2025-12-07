@if(isset($question))
    <div class="border border-gray-200 rounded-lg overflow-hidden mb-10">
        <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
            <span class="font-medium">{{$question->question}}</span>
            <div class="w-5 h-5 flex items-center justify-center">
                <i class="ri-arrow-down-s-line"></i>
            </div>
        </button>
        <div class="accordion-content p-4 border-t border-gray-200">
            {!! $question->answer !!}
        </div>
    </div>
@endif
