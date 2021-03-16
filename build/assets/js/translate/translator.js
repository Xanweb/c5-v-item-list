/* global _, xanweb */
import defaults from './defaults'

export default class Translator {
    constructor() {
        this.texts = $.extend(true, defaults, window['xanweb'] || {})
    }

    /**
     * Translate String
     *
     * @param  {String} key
     */
    translate(key) {
        let texts = this.texts
        for (let segment of key.split('.')) {
            if (!_.isObject(texts) || !texts.hasOwnProperty(segment)) {
                return null
            }

            texts = texts[segment]
        }

        return _.isObject(texts) ? null : texts
    }

    static instance() {
        return Translator._instance || (Translator._instance = new Translator())
    }
}