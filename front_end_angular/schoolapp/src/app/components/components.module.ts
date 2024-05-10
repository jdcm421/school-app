import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HeaderComponent } from './header/header.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { SiderbarComponent } from './siderbar/siderbar.component';

const components = [
  PageNotFoundComponent,
  HeaderComponent,
  SiderbarComponent,
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  declarations: [
    components,
  ],
  exports:[
    components
  ]
})
export class ComponentsModule { }
