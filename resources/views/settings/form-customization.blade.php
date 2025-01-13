<x-turbo::frame id="form-customization">
    <x-dashui-card>
        <x-slot:heading> Customization </x-slot:heading>
        <form action="{{ route('settings.form-customization') }}" method="post">
            <div class="mb-5">
                <label for="name" class="form-label">Title</label>
                <x-dashui-input
                    value="{{ $customization['title'] ?? '' }}"
                    type="text"
                    name="title"
                    id="title"
                    placeholder="title"
                />
            </div>

            <div class="mb-5">
                <label for="success_message" class="form-label">Success Message</label>
                <x-dashui-textarea
                    name="success_message"
                    autocomplete="address-line1"
                    id="success_message"
                    placeholder="Enter success message here"
                    rows="3"
                >{{ $customization['success_message'] ?? '' }}</x-dashui-textarea>
            </div>
            <br>
            <x-dashui-button type="submit" variant="primary">Save</x-dashui-button>
        </form>
    </x-dashui-card>
</x-turbo::frame>
