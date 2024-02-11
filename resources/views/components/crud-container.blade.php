<div class="crud-container">

    <div class="crud-search">
        {{ $search }}
    </div>

    <div class="flex flex-row justify-center">
        <div class="crud-sidebar">
            <div>
                <x-crud-button
                    :href="route('post.index', array_merge(request()->all(),['user_id' => auth()->id()]))"
                    type="default"
                    icon="fas fa-user"
                />
                <x-crud-button
                    :href="route('post.index', array_merge(request()->all(), ['order_by' => 'created_at', 'direction' => 'asc']))"
                    type="default"
                    icon="fas fa-caret-up"
                />
                <x-crud-button
                    :href="route('post.index', array_merge(request()->all(), ['order_by' => 'created_at', 'direction' => 'desc']))"
                    type="default"
                    icon="fas fa-caret-down"
                />
            </div>
            <div>
                {{ $buttons }}
            </div>
            <div>
                <x-crud-button
                    :href="url()->previous()"
                    type="default"
                    icon="fas fa-caret-left"
                />
            </div>
        </div>
        <div class=crud-content"">
            <div class="crud-table-container">
                <table class="crud-table">
                    {{ $table }}
                </table>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{ $pagination }}
    </div>

</div>
