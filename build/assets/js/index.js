import ItemList from './components/ItemList'
import ConcretePageInput from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'
import ColorPicker from './components/ColorPicker'
import draggable from "vuedraggable"

Concrete.Vue.createContext('itemList', {
    ItemList,
    Item,
    ConcretePageInput,
    RichTextEditor,
    ColorPicker,
    draggable
}, 'cms')

