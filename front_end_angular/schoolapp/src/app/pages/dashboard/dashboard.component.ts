import { Component, OnInit } from '@angular/core';
import { Dashboard } from 'src/app/core/response/ResponseDashboard';
import { HomeService } from 'src/app/core/service/home.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  token:string = localStorage.getItem('token') || '';
  admin:Dashboard;
  constructor(private home:HomeService){}
  ngOnInit(): void {
    this.admin={};
    this.obtener();
  }

  obtener(){
    this.home.getDashboard().subscribe(response => {
      if(response.message == 'OK'){
        console.log(response);
        this.admin = response.data || {};
      }
    }, (error:any)=> {
      console.error(error);
    });
  }
}
