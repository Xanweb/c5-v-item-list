import ItemList from './components/ItemList'
import PageSelector from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'
import ColorPicker from './components/ColorPicker'
import Draggable from 'vuedraggable'

Concrete.Vue.createContext('itemList', {
    ItemList,
    Item,
    PageSelector,
    RichTextEditor,
    ColorPicker,
    Draggable
}, 'cms')

