
import { ActivatedRouteSnapshot, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { CanActivate, Injectable } from '@nestjs/common';
import { Observable } from 'rxjs';
import { LoginService } from '../core/service/login.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(public authService : LoginService,
    private _router: Router
  ){

  }

  CanActivate(route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree{
      if(!this.authService.isAutenticated()){
        this._router.navigate(['login']);
        return false;
      }
      return this.authService.isAutenticated();
  }
}

