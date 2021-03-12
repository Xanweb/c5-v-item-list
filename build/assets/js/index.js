import ItemList from './components/ItemList'
import ConcretePageInput from './components/PageSelector'
import RichTextEditor from './components/RichTextEditor'
import Item from './components/Item'

Concrete.Vue.createContext('itemList', {
    ItemList,
    Item,
    ConcretePageInput,
    RichTextEditor
}, 'cms')

