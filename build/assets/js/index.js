import ItemList from './components/ItemList'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'
import ColorPicker from './components/ColorPicker'
import Draggable from 'vuedraggable'

if(typeof Concrete !== 'undefined') {
    createContext()
} else {
    window.addEventListener('concrete.vue.ready', function () {
        createContext()
    })
}

function createContext() {
    Concrete.Vue.createContext('itemList', {
        ItemList,
        Item,
        RichTextEditor,
        ColorPicker,
        Draggable
    }, 'cms')
}