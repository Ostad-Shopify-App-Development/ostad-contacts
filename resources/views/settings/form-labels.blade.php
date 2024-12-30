<x-turbo::frame id="form-labels">
    <x-dashui-card>
        <x-slot:heading> Form Label Settings </x-slot:heading>
        <form action="{{ route('settings.form-labels') }}" method="post">
            <div class="mb-5">
                <label for="name" class="form-label">Name</label>
                <x-dashui-input
                    value="{{ $labels['name'] ?? '' }}"
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Name"
                />
            </div>

            <div class="mb-5">
                <label for="email" class="form-label">Email</label>
                <x-dashui-input
                    value="{{ $labels['email'] ?? '' }}"
                    type="text"
                    name="email"
                    id="email"
                    placeholder="Email"
                />
            </div>

            <div class="mb-5">
                <label for="subject" class="form-label">Subject</label>
                <x-dashui-input
                    value="{{ $labels['subject'] ?? '' }}"
                    type="text"
                    name="subject"
                    id="subject"
                    placeholder="Subject"
                />
            </div>

            <div class="mb-5">
                <label for="message" class="form-label">Message</label>
                <x-dashui-input
                    value="{{ $labels['message'] ?? '' }}"
                    type="text"
                    name="message"
                    id="message"
                    placeholder="message"
                />
            </div>
            <br>
            <x-dashui-button type="submit" variant="primary">Save</x-dashui-button>
        </form>
    </x-dashui-card>
</x-turbo::frame>
