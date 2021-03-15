import ItemList from './components/ItemList'
import ConcretePageInput from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'
import draggable from "vuedraggable"

Concrete.Vue.createContext('itemList', {
    ItemList,
    Item,
    ConcretePageInput,
    RichTextEditor,
    draggable
}, 'cms')

