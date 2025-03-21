import './page/hhag-inquiry-list';
// import './page/swag-example-detail';

import deDE from '../../snippet/de-DE.json';
import enGB from '../../snippet/en-GB.json';

Shopware.Module.register('hhag-inquiry', {
    type: 'plugin',
    name: 'Example',
    title: 'hhag-inquiry.general.mainMenuItemGeneral',
    description: 'hhag-inquiry.general.descriptionTextModule',
    color: '#ff3d58',
    icon: 'default-shopping-paper-bag-product',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        list: {
            component: 'hhag-inquiry-list',
            path: 'list'
        },
        detail: {
            component: 'hhag-inquiry-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'hhag.inquiry.list'
            }
        }
    },

    navigation: [{
        label: 'hhag-inquiry.general.mainMenuItemGeneral',
        color: '#ff3d58',
        path: 'hhag.inquiry.list',
        icon: 'default-shopping-paper-bag-product',
        position: 100,
        parent: 'sw-order'
    }]
});
