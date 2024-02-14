<div class="crud-container">

    <div class="crud-search">
        {{ $search }}
    </div>

    <div class="flex flex-row justify-center">
        <div class="crud-sidebar">
            <div>
                <x-crud-button
                    :href="url()->previous()"
                    type="default"
                    icon="fas fa-caret-left"
                />
            </div>
        </div>
        {{ $table }}
    </div>
</div>
<div class="crud-pagination">
    {{ $pagination }}
</div>

</div>
