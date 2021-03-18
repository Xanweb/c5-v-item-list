import ItemList from './components/ItemList'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'
import ColorPicker from './components/ColorPicker'
import Draggable from 'vuedraggable'

Concrete.Vue.createContext('itemList', {
    ItemList,
    Item,
    RichTextEditor,
    ColorPicker,
    Draggable
}, 'cms')

