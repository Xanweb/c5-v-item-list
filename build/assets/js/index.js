import ItemList from './components/ItemList'
import ConcreteFileInput from './components/FileSelector'
import ConcretePageInput from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'
import item from './components/Item'

// Let us use Vue with our theme JS
import VueManager from './vue/Manager'
VueManager.bindToWindow(window)

window.Concrete.Vue.createContext('itemList', {
    ItemList,
    item,
    ConcreteFileInput,
    ConcretePageInput,
    RichTextEditor
});


