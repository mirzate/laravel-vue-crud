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
    path: '/countries',
    name: 'countries',
    component: page('country/CountryPage')
  },
  {
    path: '/countries/create',
    name: 'countries.create',
    component: page('country/CountryCreatePage')
  },
  {
    path: '/countries/:id/edit',
    name: 'countries.edit',
    component: page('country/CountryEditPage')
  },

  { path: '/:catchAll(.*)', name: 'notFound', component: page('errors/404') }
]
