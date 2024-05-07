import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { HeaderComponent } from './header/header.component';
import { SiderbarComponent } from './siderbar/siderbar.component';

const components = [
  PageNotFoundComponent,
  HeaderComponent,
  SiderbarComponent,
];

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [
    components,
  ],
  exports:[
    components
  ]
})
export class ComponentsModule { }
