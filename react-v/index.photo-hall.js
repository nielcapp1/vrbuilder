import React from 'react';
import { NativeModules, AppRegistry, asset, Location, Pano, Text, Animated, View, VrButton, Image, StyleSheet, CylindricalPanel, Model} from 'react-vr';
import Button from './components/button.js';
import axios from 'axios';
import TimerMixin from 'react-timer-mixin';

const Linking = NativeModules.LinkingManager

class react_vr extends React.Component {

  constructor() {
    super();
    this.state = { 
      items: [],
      currentItem: 1,
      bounceValue: new Animated.Value(1),
      disableButtonPrevious: false,
      disableButtonNext: false,
      colorButton: '#7F0000'
    };
    this.styles = StyleSheet.create({
      menu: {
        position: 'absolute',
        flex: 1,
        flexDirection: 'row',
        width: 1,
        alignItems: 'stretch',
        transform: [
          {translate: [-6.65, 5.5, -5]}
        ], 
      },
      text: { 
        fontSize: 0.15,
        textAlign: 'center',
        fontWeight: '500',
      }, 
      description: {
        fontSize: 0.30,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#000',
        color: '#FFF',
        borderRadius: .50,
        paddingTop: 0.30,
        paddingBottom: 0.30,
        textAlignVertical: 'center',
        transform: [
          {translate: [-5 , 2.8, -10]}, 
        ],
      },
      button: { 
        paddingTop: 0.05,
        paddingBottom: 0.05,
        width: 1,
        marginLeft: 0.05,
        marginRight: 0.05,
        backgroundColor: this.state.colorButton,
        borderRadius: .15,
      },
      image01: {
        borderRadius: 2.3,
        width: 4.6,
        height: 4.6,
        overflow: 'hidden',
        transform: [
          {translate: [-2.3, 2.3, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: 0}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image02: {
        borderRadius: 4.6,
        width: 9.2,
        height: 9.2,
        overflow: 'hidden',
        transform: [
          {translate: [12.5, 9.2, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: -60}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image03: {
        borderRadius: 16.5,
        width: 33,
        height: 33,
        overflow: 'hidden',
        transform: [
          {translate: [45, 30.5, 35]}, 
          {scale: this.state.bounceValue},
          {rotateY: -120}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image04: {
        borderRadius: 70,
        width: 136,
        height: 136,
        overflow: 'hidden',
        transform: [
          {translate: [-70, 115.5, 285]}, 
          {scale: this.state.bounceValue},
          {rotateY: -180}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image05: {
        borderRadius: 120,
        width: 235,
        height: 235,
        overflow: 'hidden',
        transform: [
          {translate: [-560, 300, 250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -240}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image06: {
        borderRadius: 120,
        width: 235,
        height: 235,
        overflow: 'hidden',
        transform: [
          {translate: [-540, 535, -250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -300}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      // image02: {
      //   borderRadius: 2.8,
      //   width: 5.6,
      //   height: 5.6,
      //   overflow: 'hidden',
      //   transform: [
      //     {translate: [-15, 7.4, -0]}, 
      //     {scale: this.state.bounceValue},
      //     {rotateY: 90}, 
      //     {rotateX: 0},
      //     {rotateZ: 0} 
      //   ], 
      // },
      // image03: {
      //   borderRadius: 6,
      //   width: 12,
      //   height: 12,
      //   overflow: 'hidden',
      //   transform: [
      //     {translate: [20, 16.2, -0]}, 
      //     {scale: this.state.bounceValue},
      //     {rotateY: -90}, 
      //     {rotateX: 0},
      //     {rotateZ: 0} 
      //   ], 
      // },
      // image04: {
      //   borderRadius: 23,
      //   width: 46,
      //   height: 46,
      //   overflow: 'hidden',
      //   transform: [
      //     {translate: [-23, 45, 100]}, 
      //     {scale: this.state.bounceValue},
      //     {rotateY: -180}, 
      //     {rotateX: 0},
      //     {rotateZ: 0} 
      //   ], 
      // },
    });
  }

  bounceAnimation() {
    this.state.bounceValue.setValue(1.1);
    Animated.spring(
      this.state.bounceValue,
      {
        toValue: 0.9,
        friction: 1,
      }
    ).start();
  }

  previousImage() {
    if (this.state.currentItem > 1) {
      this.setState((prevState) => ({ currentItem: prevState.currentItem - 1 }))
      this.bounceAnimation()
      console.log(this.state.currentItem-1)
      console.log(this.state.items.length)
      this.enableButtonNext()
      if ((this.state.currentItem - 1) == 1) {
        this.disableButtonPrevious()
      }
    }
  }

  nextImage() {
    if (this.state.currentItem < this.state.items.length) {
      this.setState((prevState) => ({ currentItem: prevState.currentItem + 1 }))
      this.bounceAnimation()
      this.enableButtonPrevious()
      if (this.state.items.length == (this.state.currentItem + 1)) {
        this.disableButtonNext()
      }
    }
  }

  getContent() {
    var url = Linking.getInitialURL()
    .then((url) => {
      if (url) {
        console.log('Initial url is: ' + url);
        var vrSpaceId = url.split('?vrspace=')[1];
        console.log('VR Space Id: ' + vrSpaceId);
        if (vrSpaceId == 1) {
          axios.get(`https://jsonplaceholder.typicode.com/photos`)
            .then(res => {
              const items = res.data.slice(0, 5);
              this.setState({ items });
              if (this.state.currentItem = 1) {
                this.disableButtonPrevious()
              }
              if (items.length != this.state.currentItem) {
                this.enableButtonNext()
              } else {
                this.disableButtonNext()
              }
            })
        }
        
      }
    })
    .catch(err => {
      console.error('An error occurred', err)
    })
  }

  disableButtonPrevious() {
     this.setState((prevState) => ({ disableButtonPrevious: prevState.disableButtonPrevious = true },
       { colorButton: prevState.colorButton = '#FFF' }
     ))
     this.setState({colorButton: '#FFF'})
     console.log(this.state.colorButton)
  }

  enableButtonPrevious() {
     this.setState((prevState) => ({ disableButtonPrevious: prevState.disableButtonPrevious = false },
       { colorButton: prevState.colorButton = '#FFF' }
     ))
     this.setState({colorButton: '#FFF'})
     console.log(this.state.colorButton)
  }

  disableButtonNext() {
     this.setState((prevState) => (
       { disableButtonNext: prevState.disableButtonNext = true },
       { colorButton: prevState.colorButton = '#FFF' }
     ))
     this.setState({colorButton: '#FFF'})
     console.log(this.state.colorButton)
  }

  enableButtonNext() {
     this.setState((prevState) => ({ disableButtonNext: prevState.disableButtonNext = false },
       { colorButton: prevState.colorButton = '#FFF' }
     ))
     this.setState({colorButton: '#FFF'})
     console.log(this.state.colorButton)
  }

  componentDidMount() {
    this.getContent()
    this.bounceAnimation()
  }

  render() {
    console.log(this.state.items.length)
    return (
      <View>
         <View style={this.styles.menu}>
            <VrButton disabled={this.state.disableButtonPrevious} style={this.styles.button} onEnter={() => this.previousImage()} onEnterSound={{ mp3: asset('click.mp3')}} > 
                <Text style={this.styles.text}>
                  Vorige
                </Text> 
            </VrButton>
            <VrButton disabled={this.state.disableButtonNext} style={this.styles.button} onEnter={() => this.nextImage()} onEnterSound={{ mp3: asset('click.mp3') }}> 
                <Text style={this.styles.text}>
                  Volgende
                </Text> 
            </VrButton>
            <VrButton style={this.styles.button} onEnter={() => Linking.openURL("/photo-hall")} onEnterSound={{ mp3: asset('click.mp3')}}> 
                <Text style={this.styles.text}>
                  Stop 
                </Text> 
            </VrButton>
        </View>
        <View>
          <Animated.Image style={this.styles.image01} source={asset('Lakenhallen01.jpg')}/>
        </View>
        <View>
          <Animated.Image style={this.styles.image02} source={asset('Lakenhallen01.jpg')}/>
        </View>
        {/* <View>
          <Animated.Image style={this.styles.image03} source={asset('Lakenhallen01.jpg')}/>
        </View>
        <View>
          <Animated.Image style={this.styles.image04} source={asset('Lakenhallen01.jpg')}/>
        </View>
        <View>
          <Animated.Image style={this.styles.image05} source={asset('Lakenhallen01.jpg')}/>
        </View>
        <View>
          <Animated.Image style={this.styles.image06} source={asset('Lakenhallen01.jpg')}/>
        </View> */}
          {/* {
            this.state.items
            .map(
              item => (item.id == this.state.currentItem) 
                ? 
                <View key={this.state.currentItem}>
                  <Animated.Image style={this.styles.image} source={{uri: this.state.items[this.state.currentItem-1].url}}/>
                  <Text style={this.styles.description}>{this.state.items[this.state.currentItem-1].title}</Text>
                </View>
                :
                <View>
                </View>
              )
          } */}
        
        <Pano source={asset('timeline02.png')} />
      </View>
    );
  }
};

AppRegistry.registerComponent('react_vr', () => react_vr);