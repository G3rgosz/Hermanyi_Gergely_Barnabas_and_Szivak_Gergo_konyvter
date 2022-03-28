import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RegisterComponent } from './register/register.component';
import { MainComponent } from './main/main.component';
import { NewadvertisementComponent } from './newadvertisement/newadvertisement.component';
import { MyadvertisementsComponent } from './myadvertisements/myadvertisements.component';
import { AdvertisementComponent } from './advertisement/advertisement.component';

@NgModule({
  declarations: [
    AppComponent,
    RegisterComponent,
    MainComponent,
    NewadvertisementComponent,
    MyadvertisementsComponent,
    AdvertisementComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
