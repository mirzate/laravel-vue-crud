function page (path) {
  return () => import(/* webpackChunkName: '' */ `../pages/${path}.vue`).then(m => m.default || m)
  }

export default [
  {
    path: '/',
    name: 'home',
    component: page('HomePage')
  },
  { path: '/:catchAll(.*)', name: 'notFound', component: page('errors/404') }
]
