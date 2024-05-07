import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { DashboardComponent } from '../pages/dashboard/dashboard.component';
import { PagesComponent } from '../pages/pages.component';
import { StudentComponent } from '../pages/student/student.component';
import { CourseComponent } from '../pages/course/course.component';
import { MatriculaComponent } from '../pages/matricula/matricula.component';

const routes: Routes = [
  {  path: 'login',  component: LoginComponent},
  { path:'home', component: DashboardComponent},
  {path:'admin', component: PagesComponent},
  {path:'student', component: StudentComponent},
  {path:'course', component: CourseComponent},
  {path:'matricula', component: MatriculaComponent}
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [RouterModule]
})

export class AuthRoutingModule { }
