import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';

const routes: Routes = [
  {  path: 'login',  component: LoginComponent},
  /*{ path:'home', component: DashboardComponent},
  {path:'admin', component: PagesComponent},
  {path:'student', component: StudentComponent},
  {path:'course', component: CourseComponent},
  {path:'matricula', component: MatriculaComponent}*/
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [RouterModule]
})

export class AuthRoutingModule { }
