<template>
   <nav>
      <ul class="flex mt-4 space-x-6">
          <li>
            <NavLink 
              href="/"
              :active="$page.component === 'Home'" 
            >
              Home
            </NavLink>
          </li>
          <li>
            <NavLink 
              href="/about"
              :active="$page.component === 'About'" 
            >
              Über uns
            </NavLink>
          </li>
          <li>
            <button class="uppercase rounded-full border border-black text-xs px-4 py-2 font-medium tracking-widest">Menu</button>
          </li>
      </ul>
  </nav>
</template>

<style lang="scss" scoped>

</style>