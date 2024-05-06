import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const childRouts: Routes = [

]

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forChild(childRouts)],
})
export class ChildModule {}
