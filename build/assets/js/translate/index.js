import Translator from './translator'

export default {
    /**
     * Translate String
     *
     * @param {String} key
     */
    t: key => Translator.instance().translate(key)
}