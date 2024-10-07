<div>
    <div class="mt-8">
        <h3 class="text-xl font-semibold">Leave a Review</h3>
        <form wire:submit.prevent="submitReview">
            <div class="flex flex-col gap-4">
                <select wire:model="reviewRating" class="p-2 border rounded-md">
                    <option value="">Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                <textarea wire:model="reviewComment" rows="4" class="p-2 border rounded-md" placeholder="Write your review..."></textarea>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </div>
        </form>
    </div>

    <!-- Display Reviews -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold">Reviews</h3>
        <ul>
            @foreach ($reviews as $review)
                <li class="py-2 border-b">
                    <div class="flex items-center">
                        <span class="text-yellow-500">
                            @for ($i = 1; $i <= $review->rating; $i++)
                                ★
                            @endfor
                            @for ($i = $review->rating + 1; $i <= 5; $i++)
                                ☆
                            @endfor
                        </span>
                        <span class="ml-2 text-gray-600">({{ $review->comment }})</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
