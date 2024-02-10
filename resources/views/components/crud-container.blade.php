<div class="crud-container">
    <div class="flex flex-row justify-center">
        <div class="crud-sidebar">
            {{ $buttons }}
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
