import ItemList from './components/ItemList'
import ConcreteFileInput from './components/FileSelector'
import ConcretePageInput from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'

// Let us use Vue with our theme JS
import VueManager from './vue/Manager'
VueManager.bindToWindow(window)

window.Concrete.Vue.createContext('itemList', {
    ItemList,
    ConcreteFileInput,
    ConcretePageInput,
    RichTextEditor
});


