import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { AuthRoutingModule } from './auth.routing';
import { LoginComponent } from './login/login.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    AuthRoutingModule,
    ReactiveFormsModule,
    FormsModule
  ],
  declarations: [LoginComponent]
})
export class AuthModule { }
