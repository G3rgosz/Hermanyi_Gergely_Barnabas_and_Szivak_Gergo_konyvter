import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { RegisterComponent } from './register/register.component';
import { MainComponent } from './main/main.component';
import { NewadvertisementComponent } from './newadvertisement/newadvertisement.component';
import { AuthGuard } from './shared/auth.guard';

const routes: Routes = [
  {path:'', component: MainComponent},
  {path:'register', component: RegisterComponent},
  {path:'newadvertisement', component: NewadvertisementComponent, canActivate: [AuthGuard]}
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
