import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CourseComponent } from './course/course.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { MatriculaComponent } from './matricula/matricula.component';
import { StudentComponent } from './student/student.component';

const childRouts: Routes = [
  {path: 'home', component: DashboardComponent, outlet:'home'},
  {path: 'student', component:StudentComponent, outlet:'student'},
  {path: 'course',component:CourseComponent, outlet:'course'},
  {path: 'tuition', component: MatriculaComponent, outlet:'tuition'}
]

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forChild(childRouts)],
    exports: [RouterModule]
})
export class ChildModule {}
