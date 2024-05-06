import { Component, OnInit } from '@angular/core';
import { LoginRequest } from 'src/app/core/request/LoginRequest';
import { ResponseAuth } from 'src/app/core/response/ResponseAuth';
import { LoginService } from 'src/app/core/service/login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  request: LoginRequest;

  constructor(public authService : LoginService){}

  ngOnInit(){
    this.request={};
  }

  save(){
    console.log(this.request);
    this.authService.login(this.request).subscribe(response => {
      console.log(response);
    });
  }
}
