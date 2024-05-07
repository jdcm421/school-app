import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment.prod';
import { ResponseDashboard } from '../response/ResponseDashboard';
import { HttpClient } from '@angular/common/http';
import { LoginService } from './login.service';

@Injectable({
  providedIn: 'root',
})
export class HomeService {

  private baseUrl = environment.apiUrl;
  constructor(private _http: HttpClient,
    private auth : LoginService
  ){}

  getDashboard() :Observable<ResponseDashboard>{
    return this._http.get<ResponseDashboard>(`${this.baseUrl}/admin/dashboard`,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }
}
