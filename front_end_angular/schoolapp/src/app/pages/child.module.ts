import { Component, NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';
import { StudentComponent } from './student/student.component';
import { CourseComponent } from './course/course.component';
import { MatriculaComponent } from './matricula/matricula.component';

const childRouts: Routes = [
  {path: 'home', component: DashboardComponent, outlet:'home'},
  {path: 'student', component:StudentComponent, outlet:'student'},
  {path: 'course',component:CourseComponent, outlet:'course'},
  {path: 'tuition', component:MatriculaComponent, outlet:'tuition'}
]

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forChild(childRouts)],
    exports: [RouterModule]
})
export class ChildModule {}
