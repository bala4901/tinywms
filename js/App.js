/*!
 * Ext JS Library 4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

Ext.define('MyDesktop.App', {
    extend: 'Ext.ux.desktop.App',

     requires: [
        'Ext.window.MessageBox',

        'Ext.ux.desktop.ShortcutModel',
        'Modules.samples.SystemStatus',
        'Modules.samples.GridWindow',
        'Modules.samples.TabWindow',
        'Modules.samples.AccordionWindow',
        'Modules.samples.Notepad',
        'Modules.samples.BogusMenuModule',
        'Modules.samples.BogusModule',
        'Modules.samples.Settings',
        'Modules.samples.VideoWindow',
        'Modules.samples.TestN',
        'Modules.product.GridWindow',
        'Modules.product.App',
    ],

    init: function() {
        // custom logic before getXYZ methods get called...
        this.callParent();

        // now ready...
    },

    getModules : function(){
        return [
            new Modules.samples.VideoWindow(),
            new Modules.samples.GridWindow(),
            
            new Modules.samples.SystemStatus(),
            new Modules.samples.TabWindow(),
            new Modules.samples.AccordionWindow(),
            new Modules.samples.Notepad(),
            new Modules.samples.BogusMenuModule(),
            new Modules.samples.BogusModule(),
            new Modules.samples.TestN(),
            new Modules.product.GridWindow(),
            new Modules.product.App(),
        ];
    },

    getDesktopConfig: function () {
        var me = this, ret = me.callParent();

        return Ext.apply(ret, {
            //cls: 'ux-desktop-black',

            contextMenuItems: [
                { text: 'Change Settings', handler: me.onSettings, scope: me }
            ],

            shortcuts: Ext.create('Ext.data.Store', {
                model: 'Ext.ux.desktop.ShortcutModel',
                data: [
                    { name: 'Grid Window', iconCls: 'grid-shortcut', module: 'grid-win' },
                    { name: 'Accordion Window', iconCls: 'accordion-shortcut', module: 'acc-win' },
                    { name: 'Notepad', iconCls: 'notepad-shortcut', module: 'notepad' },
                    { name: 'System Status', iconCls: 'cpu-shortcut', module: 'systemstatus'},
                    { name: 'Prod Grid Windows', iconCls: 'grid-shortcut', module: 'product.grid-win'}
                ]
            }),

            wallpaper: 'wallpapers/Blue-Sencha.jpg',
            wallpaperStretch: false
        });
    },

    // config for the start menu
    getStartConfig : function() {
        var me = this, ret = me.callParent();

        return Ext.apply(ret, {
            title: 'Don Griffin',
            iconCls: 'user',
            height: 300,
            toolConfig: {
                width: 100,
                items: [
                    {
                        text:'Settings',
                        iconCls:'settings',
                        handler: me.onSettings,
                        scope: me
                    },
                    '-',
                    {
                        text:'Logout',
                        iconCls:'logout',
                        handler: me.onLogout,
                        scope: me
                    }
                ]
            }
        });
    },

    getTaskbarConfig: function () {
        var ret = this.callParent();

        return Ext.apply(ret, {
            quickStart: [
                { name: 'Accordion Window', iconCls: 'accordion', module: 'acc-win' },
                { name: 'Grid Window', iconCls: 'icon-grid', module: 'grid-win' }
            ],
            trayItems: [
                { xtype: 'trayclock', flex: 1 }
            ]
        });
    },

    onLogout: function () {
        Ext.Msg.confirm('Logout', 'Are you sure you want to logout?');
    },

    onSettings: function () {
        var dlg = new Modules.samples.Settings({
            desktop: this.desktop
        });
        dlg.show();
    }
});
