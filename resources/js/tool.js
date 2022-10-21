import DefaultField from "./components/DefaultField";
import PanelItem from "./components/PanelItem";
import ResourceTableHeader  from "./components/ResourceTableHeader";
import MenuItem from "./components/MenuItem";

Nova.booting((app, store) => {

    app.component('DefaultField', DefaultField);
    app.component('PanelItem', PanelItem);
    app.component('ResourceTableHeader', ResourceTableHeader);
    app.component('MenuItem',MenuItem)

})
