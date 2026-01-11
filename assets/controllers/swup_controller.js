import { Controller } from '@hotwired/stimulus';
import Swup from 'swup';
import SwupFadeTheme from '@swup/fade-theme';
import SwupSlideTheme from '@swup/slide-theme';
import SwupFormsPlugin from '@swup/forms-plugin';
import SwupDebugPlugin from '@swup/debug-plugin';

export default class extends Controller {
    static values = {
        containers: Array,
        mainElement: String,
        animateHistoryBrowsing: Boolean,
        animationSelector: String,
        cache: Boolean,
        linkSelector: String,
        theme: String,
        debug: Boolean,
    };

    connect() {
        const dataContainers = this.containersValue;
        const mainElement = this.mainElementValue || dataContainers[0] || '#swup';
        const allElements = [mainElement].concat(dataContainers);
        const containersList = allElements.filter((item, index) => {
            return allElements.indexOf(item) === index;
        });

        const options = {
            containers: containersList,
            plugins: [
                'slide' === this.themeValue
                    ? new SwupSlideTheme({ mainElement: mainElement })
                    : new SwupFadeTheme({ mainElement: mainElement }),
                new SwupFormsPlugin(),
            ],
        };

        if (this.hasMainElementValue) {
            options.mainElement = this.mainElementValue;
        }

        if (this.hasAnimateHistoryBrowsingValue) {
            options.animateHistoryBrowsing = this.animateHistoryBrowsingValue;
        }
        if (this.hasAnimationSelectorValue) {
            options.animationSelector = this.animationSelectorValue;
        }
        if (this.hasCacheValue) {
            options.cache = this.cacheValue;
        }
        if (this.hasLinkSelectorValue) {
            options.linkSelector = this.linkSelectorValue;
        }
        if (this.debugValue) {
            options.plugins.push(new SwupDebugPlugin());
        }

        this.dispatchEvent('pre-connect', { options });
        const swup = new Swup(options);
        this.dispatchEvent('connect', { swup, options });
    }

    dispatchEvent(name, payload) {
        this.dispatch(name, { detail: payload, prefix: 'swup' });
    }
}