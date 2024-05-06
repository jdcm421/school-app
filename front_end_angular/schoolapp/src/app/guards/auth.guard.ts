
import { UrlTree } from '@angular/router';
import { CanActivate, Injectable } from '@nestjs/common';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(){

  }

  CanActivate(): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree{
    return false;
  }
}

