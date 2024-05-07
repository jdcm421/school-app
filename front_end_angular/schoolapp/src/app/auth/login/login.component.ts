import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { LoginRequest } from 'src/app/core/request/LoginRequest';
import { ResponseAuth } from 'src/app/core/response/ResponseAuth';
import { LoginService } from 'src/app/core/service/login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  requestLogin : LoginRequest;

  constructor(public authService : LoginService,
    private router: Router
  ){}

  ngOnInit(){
    this.requestLogin={};
  }

  save(){
    console.log(this.requestLogin);
    this.authService.login(this.requestLogin).subscribe(response => {
      console.log(response);
      if(response.message == 'OK'){
        this.router.navigateByUrl('home')
      }
    }, (Error : any) => {
      console.error(Error);
    });
  }
}
