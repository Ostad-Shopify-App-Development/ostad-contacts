import createApp from "@shopify/app-bridge";
import {getSessionToken} from "@shopify/app-bridge/utilities";
import {AppLink, NavigationMenu} from "@shopify/app-bridge/actions";
import {setupRedirectHandler} from "./navigation.js";

document.addEventListener('DOMContentLoaded', () => {
    const shopifyAppInit = document.getElementById('shopify-app-init')
    if (!shopifyAppInit) { return }
    var data = shopifyAppInit.dataset;


    window.app = createApp({
        apiKey: data.apiKey,
        host: data.host,
        forceRedirect: data.forceIframe === 'true',
    });

    // Append Shopify's JWT to every Turbo request
    document.addEventListener('turbo:before-fetch-request', async (event) => {
        event.preventDefault()
        let appEnv = document.querySelector('meta[name="app-env"]').content

        if (appEnv !== 'testing') {
            window.sessionToken = await retrieveToken();
            event.detail.fetchOptions.headers['Authorization'] = `Bearer ${window.sessionToken}`
        }

        event.detail.fetchOptions.headers['X-Requested-With'] = 'XMLHttpRequest';

        event.detail.resume()
    })


    registerEmbeddedNavManu(window.app);
    setupRedirectHandler();

});


async function retrieveToken() {
    if (window.sessionToken && window.jwtExpireAt && window.jwtExpireAt > Date.now()) {
        const diff = parseInt((window.jwtExpireAt - Date.now()) / 1000) + 's';
        console.log('[shopify_app] Reusing token. Expires in:', diff);
        return window.sessionToken;
    } else {
        console.log('[shopify_app] Get new token');
        const token = await getSessionToken(window.app);
        window.sessionToken = token;
        window.jwtExpireAt = getTokenExpiry(token);
        return token;
    }
}

function getTokenExpiry(token) {
    const expiry = (JSON.parse(atob(token.split('.')[1]))).exp;

    return (expiry * 1000) - 100;
}

function registerEmbeddedNavManu(app) {
    const homeLink = AppLink.create(app, {
        label: 'Home',
        destination: '/',
    });

    const settingsLink = AppLink.create(app, {
        label: 'Settings',
        destination: '/settings',
    });

    const dashLink = AppLink.create(app, {
        label: 'Dashboard',
        destination: '/dash',
    });


    // Setup redirect handler
    const navigationMenu = NavigationMenu.create(app, {
        items: [
            homeLink,
            settingsLink,
            dashLink,
        ],
        active: settingsLink,
    });

    navigationMenu.subscribe(NavigationMenu.Action.UPDATE, (payload) => {
        navigationMenu.set({active: payload.item});

    });
}
