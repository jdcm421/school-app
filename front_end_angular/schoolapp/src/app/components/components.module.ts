import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';

const components = [
  PageNotFoundComponent
];

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [components,

  ],
  export:[
    components
  ]
})
export class ComponentsModule { }
