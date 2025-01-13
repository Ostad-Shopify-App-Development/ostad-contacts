<x-turbo::frame id="form-general">
    <x-dashui-card>
        <x-slot:heading> General Settings </x-slot:heading>
        <form action="{{ route('settings.form-general') }}" method="post">
            <div class="mb-5">
                    <ul class="flex flex-col gap-1 lg:gap-1.5">
                        <li>
                            <input class="checkbox" type="checkbox" id="save_as_customer" name="save_as_customer" {{ $general['save_as_customer']? 'checked': '' }} value="1" />
                            <label for="save_as_customer">Save as customer</label>
                        </li>

                        <li>
                            <input class="checkbox" type="checkbox" id="send_confirmation_mail" name="send_confirmation_mail"  {{ $general['send_confirmation_mail']? 'checked': '' }} value="1" />
                            <label for="send_confirmation_mail">Send confirmation email</label>
                        </li>

                        <li>
                            <div class="mb-5">
                                <label for="name" class="form-label">Admin Notification Email</label>
                                <x-dashui-input
                                    value="{{ $general['admin_notification'] ?? null }}"
                                    type="text"
                                    name="admin_notification"
                                    id="admin_notification"
                                    placeholder="Admin notification email"
                                />
                            </div>
                        </li>
                    </ul>
            </div>


            <br>
            <x-dashui-button type="submit" variant="primary">Save</x-dashui-button>
        </form>
    </x-dashui-card>
</x-turbo::frame>
