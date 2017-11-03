
extern "C" void init_topology( shawn::SimulationController& ); 
extern "C" void init_vis( shawn::SimulationController& ); 
extern "C" void init_localization( shawn::SimulationController& ); 
extern "C" void init_reading( shawn::SimulationController& ); 
extern "C" void init_examples( shawn::SimulationController& ); 

#define INIT_STATIC_APPS_MODULES \
init_topology(sc); \
init_vis(sc); \
init_localization(sc); \
init_reading(sc); \
init_examples(sc); \


