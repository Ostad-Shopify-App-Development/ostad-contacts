<div id="app" class="flex justify-center">
    <x-dashui-action-link as="link" href="{{ url('/dash') }}" label="Dashboard" active="true" data-turbo-action="advance"/>
    <x-dashui-action-link as="link" href="{{ url('/settings') }}" label="Settings" data-turbo-action="advance" />
</div>
