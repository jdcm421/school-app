import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthRoutes } from './auth/auth.routing';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { PagesRoutes } from './pages/pages.routing';

const routes: Routes = [
  {path:'**', component: PageNotFoundComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes),
    PagesRoutes,
    AuthRoutes
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
