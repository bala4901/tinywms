/**
 * @class Bleext.abstract.TreeStore
 * @extends Ext.data.TreeStore
 * requires 
 * @autor Crysfel Villa
 * @date Tue Aug  2 14:01:18 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.abstract.TreeStore", {
    extend: "Ext.data.TreeStore",
    autoLoad: true,
    folderSort: true,
    constructor: function() {
        var me = this;

        me.proxy = {
            type: "ajax",
            url: Bleext.BASE_PATH + "index.php/" + me.url,
            params: this.params
        };

        me.callParent();
    }
});

Ext.override(Ext.data.TreeStore, {
    load: function(options) {
        options = options || {};
        options.params = options.params || {};

        var me = this,
                node = options.node || me.tree.getRootNode(),
                root;

// If there is not a node it means the user hasnt defined a rootnode yet. In this case lets just
// create one for them.
        if (!node) {
            node = me.setRootNode({
                expanded: true
            });
        }

        if (me.clearOnLoad) {
            node.removeAll(false);
        }

        Ext.applyIf(options, {
            node: node
        });
        options.params[me.nodeParam] = node ? node.getId() : 'root';

        if (node) {
            node.set('loading', true);
        }

        return me.callParent([options]);
    }

});