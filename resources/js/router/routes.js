function page (path) {
  return () => import(/* webpackChunkName: '' */ `../pages/${path}.vue`).then(m => m.default || m)
  }

export default [
  {
    path: '/',
    name: 'home',
    component: page('HomePage')
  },
  {
    path: '/customers',
    name: 'customers',
    component: page('customer/CustomerPage'),
    children: [
      {
        path: '/contacts/create/:customer_id',
        name: 'contacts.create',
        component: page('contact/ContactManagePage')
      },
      {
        path: '/contacts/:id/edit',
        name: 'contacts.edit',
        component: page('contact/ContactManagePage')
      },
    ]
  },
  {
    path: '/customers/create',
    name: 'customers.create',
    component: page('customer/CustomerManagePage')
  },
  {
    path: '/customers/:id/edit',
    name: 'customers.edit',
    component: page('customer/CustomerManagePage')
  },
  {
    path: '/countries',
    name: 'countries',
    component: page('country/CountryPage')
  },
  {
    path: '/countries/create',
    name: 'countries.create',
    component: page('country/CountryManagePage')
  },
  {
    path: '/countries/:id/edit',
    name: 'countries.edit',
    component: page('country/CountryManagePage')
  },
  { path: '/:catchAll(.*)', name: 'notFound', component: page('errors/404') }
]
