import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { RegisterComponent } from './register/register.component';
import { MainComponent } from './main/main.component';
import { AuthGuard } from './shared/auth.guard';
import { NewadvertisementComponent } from './newadvertisement/newadvertisement.component';
import { MyadvertisementsComponent } from './myadvertisements/myadvertisements.component';
import { AdvertisementComponent } from './advertisement/advertisement.component';
import { UpdateadvertisementComponent } from './updateadvertisement/updateadvertisement.component'; 
import { SettingsComponent } from './settings/settings.component';


const routes: Routes = [
  {path:'', component: MainComponent},
  {path:'register', component: RegisterComponent},
  {path:'newadvertisement', component: NewadvertisementComponent, canActivate: [AuthGuard]},
  {path:'myadvertisements', component: MyadvertisementsComponent, canActivate: [AuthGuard]},
  {path:'advertisement/:id', component: AdvertisementComponent},
  {path:'updateadvertisement/:id', component: UpdateadvertisementComponent, canActivate: [AuthGuard]},
  {path:'settings', component: SettingsComponent, canActivate: [AuthGuard]},
  {path: '**', redirectTo: ''}
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
